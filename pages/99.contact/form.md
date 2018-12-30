---
title: Contact
published: false
image: image.png

form:
    name: contact
    fields:
        -
            name: name
            label: 'Your Name'
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
            subject: "[Brick.Camp] {{ form.value.name|e }} | {{ form.value.subject|e }}"
            body: "{% include 'forms/data.html.twig' %}"
        - save:
            fileprefix: contact-
            dateformat: Ymd-His-u
            extension: txt
            body: "{% include 'forms/data.txt.twig' %}"
        - message: Thank you for getting in touch!
        - display: thankyou
---