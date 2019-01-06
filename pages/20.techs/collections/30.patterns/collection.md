---
title: Patterns
image: image.png
filter: filter-patterns

content:
    items:
        - '@taxonomy.function': pattern_1D
        - '@taxonomy.function': pattern_2D
        - '@taxonomy.function': pattern_3D
    filter:
        published: true
        type: 'tech' 
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-patterns
    id: items-filter
    classes: form-inline justify-content-center justify-content-md-between
    fields:
        -
            name: filter
            type: fieldset
            id: filter
            classes: form-inline
            fields:
                -
                    name: pattern_type
                    label: Type
                    type: select
                    id: pattern_type
                    classes: custom-select
                    options:
                        'all': 'All Types'
                        '1D':  '1D | Linear'
                        '2D':  '2D | Planar'
                        '3D':  '3D | Spatial'
                -
                    name: pattern_segsize
                    label: Parts
                    type: select
                    id: pattern_segsize
                    classes: custom-select
                    options:
                        'all': 'All Sizes'
                        '1':   '1 per segment'
                        '2':   '2 per segment'
                        '3':   '3 per segment'
                        '4':   '4 per segment'
                        '5':   '5 per segment'
                        '6':   '6 per segment'
                        '7':   '7 per segment'
                        '8':   '8 per segment'
                        '_9up': 'more parts'
        -
            name: sorting
            type: fieldset
            id: sorting
            classes: form-inline
            fields:
                - 
                    name: order_by
                    label: Order By
                    type: select
                    id: order_by
                    classes: custom-select
                    default: 'header.taxonomy.partcount'
                    options:
                        'title': 'by Title'
                        'date': 'by Date Added'
                        'modified': 'by Date Modified'
                        'header.taxonomy.partcount': 'by Part Count'
                        'random': 'in Random Order'
                -
                    name: order_dir
                    label: Order Direction
                    type: select
                    id: order_dir
                    classes: custom-select
                    default: 'asc'
                    options:
                        'asc': 'Up'
                        'desc': 'Down'
    buttons:
        submit:
            value: Filter
    process:
        redirect: >-
            /techs/collections/patterns/{% 
                set pattern_segsize = form.value.pattern_segsize                                      %}{%
                set pattern_segsize = pattern_segsize|slice(0,3) == 'all' ? 'all' : pattern_segsize   %}{%
                set pattern_type    = form.value.pattern_type                                         %}{%
                if pattern_type == 'all'                                                              %}{%
                    if pattern_segsize != 'all'                                                       %}{%
                        set filter = 'pattern_segsize:' ~ pattern_segsize ~ '/'                       %}{%
                    endif                                                                             %}{%
                else                                                                                  %}{%
                    if pattern_segsize != 'all'                                                       %}{%
                        set filter = 'pattern_' ~ pattern_type ~ '_segsize:' ~ pattern_segsize  ~ '/' %}{%
                    else                                                                              %}{%
                        set filter = 'function:pattern_' ~ pattern_type  ~ '/'                        %}{%
                    endif                                                                             %}{%
                endif                                                                                 %}{{ filter }}{%
                set order_by = form.value.order_by                                                    %}{%
                set order_dir = form.value.order_dir                                                  %}{%
                set ordering = 'orderby:' ~ order_by ~ '/orderdir:' ~ order_dir                       %}{{ ordering }}
---