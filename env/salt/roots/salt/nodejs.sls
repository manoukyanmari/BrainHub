npm:
  pkg.installed

nodejs-legacy:
  pkg.installed

npm-packages:
  npm.installed:
    - names:
      - bower
      - grunt-cli
      - yo
      - generator-karma
      - generator-angular