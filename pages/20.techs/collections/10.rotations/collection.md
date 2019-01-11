---
title: Rotations
icon: icon.png
filter: filter-rotations

content:
    items: 
        - '@taxonomy.function': stud_tilt
        - '@taxonomy.function': stud_twist
        - '@taxonomy.function': axle_tilt
    filter:
        published: true
        type: 'tech' 
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-rotations
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
                    name: rotation_type
                    label: Rotation Type
                    type: select
                    id: rotation_type
                    classes: custom-select
                    default: all
                    options:
                        'all': 'All Types'
                        'stud_tilt': 'Stud Tilt'
                        'stud_twist': 'Stud Twist'
                        # 'axle_tilt': 'Axle Tilt'
                - 
                    name: rotation_angle
                    label: Rotation Angle
                    type: select
                    id: rotation_angle
                    classes: custom-select
                    default: all
                    options:
                        'all': 'All Angles'
                        '45': '45°'
                        '90': '90°'
                        '180': '180°'
                        'all-1': '-------'
                        '_0-45': '00° - 45°'
                        '_45-90': '45° - 90°'
                        '_90-180': '90° - 180°'
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
            /techs/collections/rotations/{% 
                set rotation_angle = form.value.rotation_angle                                   %}{%
                set rotation_angle = rotation_angle|slice(0,3) == 'all' ? 'all' : rotation_angle %}{%
                set rotation_type  = form.value.rotation_type                                    %}{%
                if rotation_type == 'all'                                                        %}{%
                    if rotation_angle != 'all'                                                   %}{%
                        set filter = 'rotation_angle:' ~ rotation_angle ~ '/'                    %}{%
                    endif                                                                        %}{%
                else                                                                             %}{%
                    if rotation_angle != 'all'                                                   %}{%
                        set filter = rotation_type ~ '_angle:' ~ rotation_angle ~ '/'            %}{%
                    else                                                                         %}{%
                        set filter = 'function:' ~ rotation_type ~ '/'                           %}{%
                    endif                                                                        %}{%
                endif                                                                            %}{{ filter }}{%
                set order_by = form.value.order_by                                               %}{%
                set order_dir = form.value.order_dir                                             %}{%
                set ordering = 'orderby:' ~ order_by ~ '/orderdir:' ~ order_dir                  %}{{ ordering }}

---