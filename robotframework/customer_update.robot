*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_update 

*** Variables ***
${URL}            http://localhost:3001
${BROWSER}        chrome

*** Test Cases ***
Invalid Register
    [Documentation]    All required fields are completed.
    [tags]             customer_update     smoke
    Click Button       id=btnCreate
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai
    Input Text         id=password      12345    
    Click Button       id=submit    
    Wait Until Page Contains Element    xpath=//div[contains(text(), 'Please fill out this field.')]  
    Sleep              1s    # Wait for alert to appear (optional)    
    Handle Alert
    Wait Until Page Contains  USERS
    

    