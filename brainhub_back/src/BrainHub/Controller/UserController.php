<?php

namespace BrainHub\Controller;

use BrainHub\Document\UserType;
use BrainHub\Dto\User\UserDto;
use BrainHub\Persistence\SlimConfig;
use BrainHub\Document\User;

$app = SlimConfig::getApp();
$userDM = SlimConfig::getDocumentManager()->getRepository('\BrainHub\Document\User');


$app->get('/users/become-god/', function() use ($app, $userDM){

    $user = User::getCurrentUser();

    if($user == null){
        $app->render(401, array('msg' => 'You got down to hell now!!!'));
    }

    $user->isGod = true;

    SlimConfig::getDocumentManager()->persist($user);
    SlimConfig::getDocumentManager()->flush();

    $app->render(201, array('msg' => 'You are GOD now!!!'));

});

$app->get('/users/(:id)', function($id) use ($app, $userDM){

    $user = $userDM->find($id);

    if($user == null){
        $app->render(404, array(
            'msg' => 'User not found'
        ));
    }

    $userDTO = new UserDto($user);

    $app->render(200, array(
        'data' => $userDTO
    ));

});

$app->get('/users', function() use ($app, $userDM) {

    if(!User::isGod()) {
        $app->render(401, array('msg' => 'Access denied'));
    }

    $users = SlimConfig::getDocumentManager()->getRepository('BrainHub\Dto\User\UserListElementDTO')->findAll();
    
    $app->render(200, array(
        'data' => $users,
    ));
});

$app->post('/users/register', function() use ($app, $userDM) {

    $requestData = json_decode($app->request->getBody());

    $user = $userDM->findOneBy(array('email' => $requestData->email));

//    if($user != null){
//        $app->render(500, array('msg' => 'User with ' . $requestData->email . ' already exists'));
//    }

    $user = new User();
    $user->name = $requestData->name;
    $user->email = $requestData->email;
    //$user->password = password_hash($requestData->password, PASSWORD_DEFAULT);
    //$user->type = $requestData->type;

    SlimConfig::getDocumentManager()->persist($user);
    SlimConfig::getDocumentManager()->flush();

    $message = \Swift_Message::newInstance('Complete your registration')
        ->setFrom(array('no-reply@brainhub.me' => 'BrainHub team'))
        ->setTo(array($user->email))
        ->setBody('Welcome to BrainHub ' . $user->name . '. Your id is here: ' . $user->id);

    SlimConfig::getMailer()->send($message);
    
    $app->render(201, array());

});

$app->post('/users/login', function() use ($app, $userDM) {
    
    $requestData = json_decode($app->request->getBody());

    $user = $userDM->findOneBy(array('email' => $requestData->email));

    if($user == null or !password_verify($requestData->password, $user->password)){
        $app->render(401, array('msg' => 'Authorisation failed'));
    }

    $authToken = bin2hex(openssl_random_pseudo_bytes(16));

    $user->authToken = $authToken;

    SlimConfig::getDocumentManager()->persist($user);
    SlimConfig::getDocumentManager()->flush();

    $userDto = new UserDto($user);
    $authData = new \stdClass();
    $authData->token = $authToken;
    $authData->user = $userDto;

    $app->render(200, array(
        'data' => $authData,
    ));
    
});