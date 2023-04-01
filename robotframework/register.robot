*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      register 

*** Variables ***
${URL}            http://127.0.0.1:8000/admin/customer
${BROWSER}        chrome

*** Test Cases ***
Valid Register
    [Documentation]    All required fields are completed.
    [tags]             register     smoke
    Maximize Browser Window
    Click Link         id=btnCreate
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai5
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
    Wait Until Page Contains    กรุณาระบุชื่อ
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[2]/div
    Wait Until Page Contains    กรุณาระบุนามสกุล
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[3]/div
    Wait Until Page Contains    กรุณาระบุชื่อผู้ใช้
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[4]/div
    Wait Until Page Contains    กรุณาระบุรหัผ่าน

Invalid Register with Existing Username  
    [Documentation]    Username has been used
    [Tags]             register    
    Sleep              2s
    Input Text         id=firstName     วิชัย
    Input Text         id=lastName      ใจซื่อ
    Input Text         id=username      wichai5
    Input Text         id=password      12345    
    Click Button       id=submit            
    Wait Until Element Is Visible   xpath=/html/body/div[1]/div/div/form/div[3]/div
    Wait Until Page Contains    ชื่อผู้ใช้นี้มีอยู่แล้ว
    Sleep              2s