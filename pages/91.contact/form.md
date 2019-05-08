---
title: Contact
icon: image.png

form:
    name: contact
    fields:
        -
            id: contact_name
            name: name
            label: 'Name'
            placeholder: 'John Doe'
            type: text
            validate:
                required: true
        -
            id: contact_email
            name: email
            type: honeypot
        -
            id: contact_person
            name: person
            label: 'E-Mail'
            placeholder: 'me@example.com'
            type: email
            validate:
                required: true
        -
            id: contact_sobject
            name: subject
            label: 'Subject'
            placeholder: 'My message title'
            type: text
            validate:
                required: true
        -
            id: contact_message
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
            body: "{% include 'partials/mail/contact.html.twig' %}"
            cc: "{{ form.value.person|e }}"
            reply_to: "{{ form.value.person|e }}"
        - display: /contact/thanks
---

Drop me a message here if you have any questions / suggestions / feedback concerning this site. I'm happy to get in touch with you!

Alternatively, you can reach out to [my Mastodon account](https://my.brick.camp/@tobias) if you like.