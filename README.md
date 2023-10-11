# Run Crocoblock Plugins Tests With PHP On LambdaTest

## Before you start

Before you begin automation testing with Selenium, you would need to:

* Make sure that you have the latest **PHP** installed on your system. You can download and install **PHP** using following commands in the terminal:

  * **MacOS:** 
  ```bash
  /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
  brew install php
  ```
  or if you already have Homebrew package manager
  ```bash
  brew install php
  ```

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

### For Windows Users ####

**1.** Run CMD as administrator

**2.** Paste this code to install choco

```bash
@"%SystemRoot%\System32\WindowsPowerShell\v1.0\powershell.exe" -NoProfile -InputFormat None -ExecutionPolicy Bypass -Command "iex ((New-Object System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))" && SET "PATH=%PATH%;%ALLUSERSPROFILE%\chocolatey\bin"
```

**3.** Restart CMD as administrator and run this command

```bash
choco install php
```

**4.** Restart CMD as administrator and run this command

```bash
choco install composer
```

**5.*** Restart CMD as administrator and run this command

```bash
choco install git
```

**6.** Clone the repository to your computer by creating the necessary folder for this in advance and going to it

```bash
git clone https://github.com/Crocoblock/crocoblock-automation.git
```

**7.** In the folder with the project, run the command
```bash
composer update
```

**Note:** Most likely we will receive a message that you need to install the extension for the zip archive, you can simply enable it in the **php.ini** file where php itself is installed. There will be a hint where to look at the file location

**8.** Enable zip extension, in the file **php.ini** itself you just need to remove the ";" before the name of the extension. Next, run the command again

```bash
composer update
```

**9.** In the project folder, create a config.json file with the following contents

```bash
{
  "username": "YOUR_USERNAME",
  "access_key": "YOUR_ACCESS_KEY"
}
```
**Note:** take your login and access key from your LambdaTest account
 
**10**. Run the test

```bash
php dispatch-tests.php
```

**11.** If the test does not run due to an error in the **ssl certificate**, then take the following steps. Download this file [**cacert.pem**](https://curl.se/ca/cacert.pem) Save it in the project folder. In the php.ini file, write the path to the cacert.pem file [here](https://tppr.me/W2T41)

**12.** Run the test

```bash
php dispatch-tests.php
```
