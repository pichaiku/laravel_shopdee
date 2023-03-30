*** Settings ***
Library           SeleniumLibrary

Suite Setup       Open Browser    ${URL}    ${BROWSER}
Suite Teardown    Close Browser
Default Tags      customer_update 

*** Variables ***
${URL}            http://localhost:3001
${BROWSER}        chrome

*** Test Cases ***
# Valid Register
#     [Documentation]    All required fields are completed.
#     [tags]             customer_update     smoke
#     Click Button       id=btnCreate
#     Input Text         id=firstName     วิชัย
#     Input Text         id=lastName      ใจซื่อ
#     Input Text         id=username      wichai
#     Input Text         id=password      12345    
#     Click Button       id=submit    
#     Sleep              1s    # Wait for alert to appear (optional)    
#     Handle Alert
#     Wait Until Page Contains  USERS
    
Invalid Register with Some Blank Feilds
    [Documentation]    Some required fields are not completed.
    [Tags]             customer_update
    Sleep              1s
    Click Button       id=btnCreate
    Input Text         id=firstName     วิภา
    Input Text         id=lastName      มาดี
    Input Text         id=username      wipa
    Input Text         id=password      ""   
    Click Button       id=submit  
    Wait Until Page Contains Element    xpath=//div[contains(text(), 'Please fill out this field.')]    
    