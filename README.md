# Run Crocoblock Plugins Tests With PHP On LambdaTest

## Before you start

Before you begin automation testing with Selenium, you would need to:

* Make sure that you have the latest **PHP** installed on your system. You can download and install **PHP** using following commands in the terminal:

  * **MacOS:** For the latest **MacOS** versions, **PHP** has to be downloaded and installed manually by using below commands: 
  ```bash
  /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
  brew install php
  ```
  or if you already have Homebrew package manager
  ```bash
  brew install php
  ```
    * **Windows:** 
  ```bash
  sudo apt-get install curl libcurl3 libcurl3-dev php
  ```
  **Note:** For **Windows**, you can download **PHP** from [here](http://windows.php.net/download/). Also, refer to this [documentation](http://php.net/manual/en/install.windows.php) for ensuring the accessibility of PHP through Command Prompt(cmd).

* Download **composer** in the project directory ([Linux/MacOS](https://getcomposer.org/download/), [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)).

  **Note:** To use the **composer** command directly, it either should have been downloaded in the project directory or should be accessible globally which can be done by the command below:
  ```bash
  mv composer.phar /usr/local/bin/composer
  ```

### Installing Selenium Dependencies

**Step 1:** Clone this repository and go to crocoblock-automation folder:

```bash
git clone https://github.com/Crocoblock/crocoblock-automation
cd crocoblock-automation
```
**Step 2:** Install the composer dependencies in the current project directory using the command below:
```bash
composer install
```

### Setting Up Your Authentication

Make sure you have your LambdaTest credentials with you to run test automation scripts on LambdaTest Selenium Grid. You can obtain these credentials from the [LambdaTest Automation Dashboard](https://automation.lambdatest.com/build) or through [LambdaTest Profile](https://accounts.lambdatest.com/login).

**Step 3:** Set LambdaTest `username` and `access_key` into config.json.

Create in folder crocoblock-automation file config.json with next content

```json
{
  "username": "YOUR_USERNAME",
  "access_key": "YOUR_ACCESS_KEY"
}
```

### Executing the Tests

**Step 4:** The tests can be executed in the terminal using the following command:

```bash
php dispatch-tests.php
```
Your test results would be displayed on the test console (or command-line interface if you are using terminal/cmd) and on [LambdaTest automation dashboard](https://automation.lambdatest.com/build).

<img width="804" alt="image" src="https://github.com/Crocoblock/crocoblock-automation/assets/4987981/6d1bc3d8-c232-404d-be1e-8ff3f7903c66">

