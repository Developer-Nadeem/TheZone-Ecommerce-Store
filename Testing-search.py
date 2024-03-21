from selenium import webdriver
from selenium.webdriver.chrome.service import Service as ChromeService
from selenium.webdriver.common.keys import Keys
from webdriver_manager.chrome import ChromeDriverManager


#set-up
options = webdriver.ChromeOptions()
options.add_experimental_option("detach", True)
driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)

# navigate to homepage
driver.get("http://220038500.cs2410-web01pvm.aston.ac.uk/TheZone/")

# find the search bar
if(driver.find_element('xpath','/html/body/header/nav/div/div/form/input')):
    inputfield = driver.find_element('xpath','/html/body/header/nav/div/div/form/input')
    #input "jumper"
    inputfield.send_keys("jumper")
    inputfield.send_keys(Keys.ENTER)

