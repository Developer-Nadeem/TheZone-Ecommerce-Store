from selenium import webdriver
from selenium.webdriver.chrome.service import Service as ChromeService
from selenium.webdriver.common.keys import Keys
from webdriver_manager.chrome import ChromeDriverManager
import time


#set-up
options = webdriver.ChromeOptions()
options.add_experimental_option("detach", True)
driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)

# navigate to homepage
driver.get("http://220038500.cs2410-web01pvm.aston.ac.uk/TheZone/")

# find login button
if(driver.find_element('xpath','/html/body/header/nav/div/div/ul[2]/li[2]/a')):
    login_btn = driver.find_element('xpath','/html/body/header/nav/div/div/ul[2]/li[2]/a')
    login_btn.click()
    # find email input field
    email_field = driver.find_element('xpath','/html/body/main/div/div/div[2]/form[1]/div[1]/input')
    email_field.send_keys("adminNadeem@gmail.com")
    time.sleep(1)
    # find password field
    pass_field = driver.find_element('xpath','/html/body/main/div/div/div[2]/form[1]/div[2]/input')
    pass_field.send_keys("adminNadeem1@")
    time.sleep(1)
    # click the login button
    click_login = driver.find_element('xpath','/html/body/main/div/div/div[2]/form[1]/div[4]/input[1]')
    click_login.click()
    time.sleep(10)


