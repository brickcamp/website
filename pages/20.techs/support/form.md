---
title: Support
image: image.png
sitemap:
    ignore: true

form:
    name: addpage-tech
    fields:
        -
            name: title
            label: Title
            type: text
            validate:
                required: true
        -
            name: image
            label: 'Image to upload'
            type: file
            multiple: false
            accept:
                - 'image/*'
            destination: '@self'
        -
            name: taxonomy.part
            label: 'Parts'
            description: 'Coma-seperated list of part IDs'
            type: text
        -
            name: email
            type: honeypot
    buttons:
        -
            type: submit
            value: Submit
    process:
        -
            redirect: '@self'
---