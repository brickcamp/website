---
title: Patterns
icon: icon.png
filter: filter-patterns

content:
    items:
        - '@taxonomy.function': pattern_1D
        - '@taxonomy.function': pattern_2D
        # - '@taxonomy.function': pattern_3D
    filter:
        published: true
        type: 'tech' 
    order:
        by: header.taxonomy.partcount
        dir: asc
    limit: 12
    pagination: true

########################################################################
# Needed because size of paginated collection can't be queried
# See issue https://github.com/getgrav/grav-plugin-pagination/issues/29
unpaginated:
    items:
        - '@taxonomy.function': pattern_1D
        - '@taxonomy.function': pattern_2D
        # - '@taxonomy.function': pattern_3D
    filter:
        published: true
        type: 'tech' 
########################################################################

form:
    name: filter-patterns
    id: items-filter
    classes: row
    fields:
        -
            name: filter
            type: fieldset
            id: filter
            classes: "col-12 col-md-6 text-center text-md-left"
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
                        '1':   'repeat 1 part'
                        '2':   'repeat 2 parts'
                        '3':   'repeat 3 parts'
                        '4':   'repeat 4 parts'
                        '5':   'repeat 5 parts'
                        '6':   'repeat 6 parts'
                        '7':   'repeat 7 parts'
                        '8':   'repeat 8 parts'
                        '_9up': 'more parts'
        -
            name: sorting
            type: fieldset
            id: sorting
            classes: "col-12 col-md-6 text-center text-md-right"
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
            /techs/patterns/{% 
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