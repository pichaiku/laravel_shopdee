*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_update 

*** Variables ***
${URL}            http://127.0.0.1:8000/admin/customer
${BROWSER}        chrome

*** Test Cases ***
Valid Register
    [Documentation]    All required fields are completed.
    [tags]             register     smoke
    Click Link         id=btnCreate
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai
    Input Text         id=password      12345    
    Click Button       id=submit        
    Wait Until Element Is Visible   xpath=/html/body/div[2]/div/div[6]/button[1]
    Click Button        xpath=/html/body/div[2]/div/div[6]/button[1]

Invalid Register with Some Blank Feilds
    [Documentation]    Some required fields are not completed.
    [Tags]             register    
    Sleep              2s
    Click Link         id=btnCreate
    Input Text         id=firstName     ${EMPTY}
    Input Text         id=lastName      ${EMPTY}    
    Input Text         id=username      ${EMPTY}
    Input Text         id=password      ${EMPTY}    
    Click Button       id=submit        
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[1]/div
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[2]/div
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[3]/div
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[4]/div


Invalid Register with Existing Username    
    