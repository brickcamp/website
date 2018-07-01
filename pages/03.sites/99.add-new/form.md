---
menu: 'Add new'
routable: true
visible: true
image: image.png

pageconfig:
    parent: /tech/drafts

pagefrontmatter:
    visible: true
    status: draft
    template: tech

form:
    name: test
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
            message: "{{ form.value.title }}"
---