---
title: Muster
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
                    label: Art
                    type: select
                    id: pattern_type
                    classes: custom-select
                    options:
                        'all': 'Alle Arten'
                        '1D':  '1D | Linear'
                        '2D':  '2D | Planar'
                        '3D':  '3D | Räumlich'
                -
                    name: pattern_segsize
                    label: Teile
                    type: select
                    id: pattern_segsize
                    classes: custom-select
                    options:
                        'all': 'Alle Größen'
                        '1':   'je 1 Teil'
                        '2':   'je 2 Teile'
                        '3':   'je 3 Teile'
                        '4':   'je 4 Teile'
                        '5':   'je 5 Teile'
                        '6':   'je 6 Teile'
                        '7':   'je 7 Teile'
                        '8':   'je 8 Teile'
                        '_9up': 'mehr Teile'
        -
            name: sorting
            type: fieldset
            id: sorting
            classes: "col-12 col-md-6 text-center text-md-right"
            fields:
                - 
                    name: order_by
                    label: Sortieren nach
                    type: select
                    id: order_by
                    classes: custom-select
                    default: 'header.taxonomy.partcount'
                    options:
                        'title': 'nach Titel'
                        'date': 'nach Erstelldatum'
                        'modified': 'nach Änderungsdatum'
                        'header.taxonomy.partcount': 'nach Teilezahl'
                        'random': 'nach Zufall'
                -
                    name: order_dir
                    label: Sortierrichtung
                    type: select
                    id: order_dir
                    classes: custom-select
                    default: 'asc'
                    options:
                        'asc': 'Auf'
                        'desc': 'Ab'
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