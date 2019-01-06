---
title: Support Us
image: image.png

pageconfig:
    parent: /tech/drafts

pagefrontmatter:
    visible: true
    status: draft
    template: tech

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
            label: 'Part IDs (comma separated)'
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
            addpage: null
        -
            redirect: '@self'
---