---
title: Formen
icon: icon.png
filter: filter-shapes

content:
    items:
        - '@taxonomy.function': shape_2D
        - '@taxonomy.function': shape_3D
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
        - '@taxonomy.function': shape_2D
        - '@taxonomy.function': shape_3D
    filter:
        published: true
        type: 'tech' 
########################################################################

form:
    name: filter-shapes
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
                    name: shape_type
                    label: Type
                    type: select
                    id: shape_type
                    classes: custom-select
                    options:
                        'all':    'Alle Arten'
                        'all-1':  '-----------------'
                        '2D':     '2D   | Alle Flächen'
                        '2D:3':   '2D.3 | Dreieck'
                        '2D:4':   '2D.4 | Rechteck'
                        '2D:5':   '2D.5 | Pentagon'
                        '2D:6':   '2D.6 | Hexagon'
                        '2D:7':   '2D.7 | Heptagon'
                        '2D:8':   '2D.8 | Oktagon'
                        '2D:_9up': '2D.+ | Kreis'
                        'all-2':  '-----------------'
                        '3D':     '3D   | Alle Körper'
                -
                    name: shape_segsize
                    label: Parts
                    type: select
                    id: shape_segsize
                    classes: custom-select
                    options:
                        'all': 'Alle Größen'
                        '1':   '1 pro Segment'
                        '2':   '2 pro Segment'
                        '3':   '3 pro Segment'
                        '4':   '4 pro Segment'
                        '5':   '5 pro Segment'
                        '6':   '6 pro Segment'
                        '7':   '7 pro Segment'
                        '8':   '8 pro Segment'
                        '_9up': 'mehr Teile'
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
                        'title': 'nach Titel'
                        'date': 'nach Erstelldatum'
                        'modified': 'nach Änderungsdatum'
                        'header.taxonomy.partcount': 'nach Teilezahl'
                        'random': 'nach Zufall'
                -
                    name: order_dir
                    label: Order Direction
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
            /techs/shapes/{% 
                set shape_segsize = form.value.shape_segsize                                        %}{%
                set shape_segsize = shape_segsize[:3] == 'all' ? 'all' : shape_segsize              %}{%

                set shape_type     = form.value.shape_type                                          %}{%
                set shape_segments = shape_type[2:1] != ':' ? 'all' : shape_type[3:]                %}{%
                set shape_type     = shape_type[:3] == 'all' ? 'all' : 'shape_' ~ shape_type[:2]    %}{%

                if shape_type == 'all'                                                              %}{%
                    if shape_segsize != 'all'                                                       %}{%
                        set filter = 'shape_segsize:' ~ shape_segsize  ~ '/'                        %}{%
                    endif                                                                           %}{%
                else                                                                                %}{%
                    if shape_segsize == 'all' and shape_segments == 'all'                           %}{%
                        set filter = 'function:' ~ shape_type  ~ '/'                                %}{%
                    else                                                                            %}{%
                        if shape_segments != 'all'                                                  %}{%
                            set filter = shape_type ~ '_segments:' ~ shape_segments ~ '/'           %}{%
                        endif                                                                       %}{%

                        if shape_segsize != 'all'                                                   %}{%
                            set filter = filter ~ shape_type ~ '_segsize:' ~ shape_segsize  ~ '/'   %}{%
                        endif                                                                       %}{%
                    endif                                                                           %}{%
                endif                                                                               %}{{ filter }}{%
                set order_by = form.value.order_by                                                  %}{%
                set order_dir = form.value.order_dir                                                %}{%
                set ordering = 'orderby:' ~ order_by ~ '/orderdir:' ~ order_dir                     %}{{ ordering }}
---