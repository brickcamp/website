---
title: Kontakt
icon: image.png
image: image.png

form:
    name: contact
    fields:
        -
            id: contact_name
            name: name
            label: 'Name'
            placeholder: 'Marie Musterfrau'
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
            label: 'Betreff'
            placeholder: 'Titel meiner Nachricht'
            type: text
            validate:
                required: true
        -
            id: contact_message
            name: message
            label: 'Nachricht'
            placeholder: 'Hier folgt mein Feedback / meine Frage / ...'
            type: textarea
            validate:
                required: true

    buttons:
        -
            type: submit
            value: Senden
        
    process:
        - email:
            subject: "[Brick.Camp] {{ form.value.subject|e }}"
            body: "{% include 'partials/mail/contact.html.twig' %}"
            cc: "{{ form.value.person|e }}"
            reply_to: "{{ form.value.person|e }}"
        - display: /contact/thanks
---

Schreibe mir hier eine Nachricht falls Du Fragen / Vorschläge / Feedback zu dieser Website hast.

Alternativ kannst Du mich über [mein Mastodon-Konto](https://my.brick.camp/@tobias) kontaktieren wenn Du magst.