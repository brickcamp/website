---
title: All Rotations
image: image.png
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
    classes: form-inline
    fields:
        -
            name: rotation_type
            label: Rotation Type
            type: select
            id: rotation_type
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

        # - 
        #     name: order
        #     #label: Order By
        #     type: select
        #     id: order
        #     outerclasses: new-line
        #     default: date
        #     options:
        #         'newest':        'Newest'
        #         'oldest':        'Oldest'
        #         'last_modified': 'Last modified'
        #         'sep1' :         '-------------'
        #         'biggest':       'Biggest'
        #         'smallest':      'Smallest'
        #         'most_parts':    'Most Parts'
        #         'least_parts':   'Least Parts'
        #         'sep2' :         '-------------'
        #         'random':        'Random'

        - 
            name: order_by
            label: Order By
            type: select
            id: order_by
            outerclasses: new-line
            default: date
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
            default: desc
            options:
                'asc': 'Ascending'
                'desc': 'Descending'

    buttons:
        submit:
            value: Filter
    process:
        # filter: true
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
                set order = form.value.order                                                     %}{%
                set order_dir = form.value.order_dir                                             %}{%
                set ordering = 'orderby:' ~ order_by ~ '/orderdir:' ~ order_dir                  %}{{ ordering }}

---