---
title: Contact
icon: image.png

form:
    name: contact
    fields:
        -
            name: name
            label: 'Name'
            placeholder: 'John Doe'
            type: text
            validate:
                required: true
        -
            name: email
            type: honeypot
        -
            name: person
            label: 'E-Mail'
            placeholder: 'me@example.com'
            type: email
            validate:
                required: true
        -
            name: subject
            label: 'Subject'
            placeholder: 'My message title'
            type: text
            validate:
                required: true
        -
            name: message
            label: 'Message'
            placeholder: 'Here goes my feedback / question / request / ...'
            type: textarea
            validate:
                required: true

    buttons:
        -
            type: submit
            value: Send
        
    process:
        - email:
            subject: "[Brick.Camp] {{ form.value.subject|e }}"
            body: "{% include 'partials/mail/body.html.twig' %}"
            cc: "{{ form.value.person|e }}"
            reply_to: "{{ form.value.person|e }}"
        - message: "Thank you for getting in touch!"
---