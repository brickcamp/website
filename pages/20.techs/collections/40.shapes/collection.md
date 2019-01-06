---
title: Shapes
image: image.png
filter: filter-shapes

content:
    items:
        - '@taxonomy.function': shape_2D
        - '@taxonomy.function': shape_3D
    filter:
        published: true
        type: 'tech' 
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-shapes
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
                    name: shape_type
                    label: Type
                    type: select
                    id: shape_type
                    classes: custom-select
                    options:
                        'all':    'All Types'
                        'all-1':  '-----------------'
                        '2D':     '2D   | All Forms'
                        '2D:3':   '2D.3 | Triangle'
                        '2D:4':   '2D.4 | Rectangle'
                        '2D:5':   '2D.5 | Pentagon'
                        '2D:6':   '2D.6 | Hexagon'
                        '2D:7':   '2D.7 | Heptagon'
                        '2D:8':   '2D.6 | Octagon'
                        '2D:_9up': '2D.+ | Circle'
                        'all-2':  '-----------------'
                        '3D':     '3D   | All Bodies'
                -
                    name: shape_segsize
                    label: Parts
                    type: select
                    id: shape_segsize
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
            /techs/collections/shapes/{% 
                set shape_segsize = form.value.shape_segsize                                        %}{%
                set shape_segsize = shape_segsize[:3] == 'all' ? 'all' : shape_segsize              %}{%

                set shape_type     = form.value.shape_type                                          %}{%
                set shape_segments = shape_type[2:1] != ':' ? 'all' : shape_type[3:]                %}{%
                set shape_type     = shape_type[:3] == 'all' ? 'all' : 'shape_' ~ shape_type[:2]    %}{%

                if shape_type == 'all'                                                              %}{%
                    if shape_segsize != 'all'                                                       %}{%
                        set filter = 'shape_segsize:' ~ shape_segsize                               %}{%
                        endif                                                                       %}{%
                else                                                                                %}{%
                    if shape_segsize == 'all' and shape_segments == 'all'                           %}{%
                        set filter = 'function:' ~ shape_type  ~ '/'                                %}{%
                    else                                                                            %}{%
                        if shape_segments != 'all'                                                  %}{%
                            set filter = shape_type ~ '_segments:' ~ shape_segments~ '/'            %}{%
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