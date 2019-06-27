---
title: Technik vorschlagen
icon: icon.png
image: image.png

form:
    name: propose_tech
    fields:
        -
            id: propose_tech_title
            name: title
            label: 'Titel'
            placeholder: 'Brick 2 x 4 with Magic'
            type: text
            validate:
                required: true
        -
            id: propose_tech_email
            name: email
            type: honeypot
        -
            id: propose_tech_source
            name: source
            label: 'Quelle (URL)'
            placeholder: 'https://example.com/all-about-magic-brick-2x4'
            type: url
            validate:
                required: true
        -
            id: propose_tech_function
            name: function
            type: checkboxes
            label: 'Funktion'
            options:
                rotation: 'Rotation'
                offset: 'Abstand'
                pattern: 'Muster'
                shape: 'Form'
                else: 'Etwas anderes (siehe Kommentar)'
            validate:
                required: true
        -
            id: propose_tech_comment
            name: comment
            label: 'Kommentar'
            placeholder: 'Notiere Details oder Erklärungen falls nötig.'
            type: textarea
        -
            id: propose_tech_name
            name: name
            type: honeypot
        -
            id: propose_tech_person
            name: person
            label: 'E-Mail'
            placeholder: 'me@example.com'
            type: email
            description: "Optional. Falls Fragen offen sind, ich Hilfe brauche ... und zum Danke sagen."

    buttons:
        -
            type: submit
            value: Vorschlag senden
        
    process:
        - email:
            subject: "[Brick.Camp] Proposed Tech named \"{{ form.value.title|e }}\""
            body: "{% include 'partials/mail/add.html.twig' %}"
        - display: /contact/thanks
---

Falls eine interessante Bautechnik auf dieser Webseite fehlt, dann schicke sie mir gerne hier.