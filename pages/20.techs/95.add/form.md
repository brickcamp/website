---
title: Propose Tech
icon: icon.png
image: image.png

form:
    name: propose_tech
    fields:
        -
            id: propose_tech_title
            name: title
            label: 'Title'
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
            label: 'Source URL'
            placeholder: 'https://example.com/all-about-magic-brick-2x4'
            type: url
            validate:
                required: true
        -
            id: propose_tech_function
            name: function
            type: checkboxes
            label: 'Function'
            options:
                rotation: 'Rotation'
                offset: 'Offset'
                pattern: 'Pattern'
                shape: 'Shape'
                else: 'Something else (see Comment)'
            validate:
                required: true
        -
            id: propose_tech_comment
            name: comment
            label: 'Comment'
            placeholder: 'Add details or explanation if needed.'
            type: textarea
        -
            name: image
            label: 'Image'
            type: file
            multiple: true
            accept:
                - 'image/*'
            destination: 'user/data/files'
            avoid_overwriting: true
            validate:
                required: false
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
            description: "Optional. If questions arise, help is needed ... or just to Thank You."

    buttons:
        -
            type: submit
            value: Submit Proposal
        
    process:
        - email:
            subject: "[Brick.Camp] Proposed Tech named \"{{ form.value.title|e }}\""
            body: "{% include 'partials/mail/add.html.twig' %}"
            attachments:
                - image
        - message: "Thanks for your proposal!"
        - reset: true
---

In case you find an interesting technique missing on this site, please submit it here.