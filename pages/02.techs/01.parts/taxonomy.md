---
title: Part
image: image.png
filter: filter-parts

terms:
    taxonomy: part
    pool: 'techs/using'

form:
    name: filter-parts
    id: items-filter
    fields:
        -
            name: part_search
            label: Search
            type: text
            id: part_search

    buttons:
        submit:
            value: Filter
---