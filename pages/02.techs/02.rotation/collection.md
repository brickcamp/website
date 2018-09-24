---
title: Rotation
image: image.png
filter: filter-rotations

content:
    items: 
        - '@taxonomy.function': stud_tilt
        - '@taxonomy.function': stud_twist
        - '@taxonomy.function': axle_tilt
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-rotations
    id: items-filter
    fields:
        -
            name: rotation_type
            label: Type
            type: select
            id: rotation_type
            options:
                'all': '- All -'
                'stud_tilt': 'Stud Tilt'
                'stud_twist': 'Stud Twist'
                'axle_tilt': 'Axle Tilt'

        - 
            name: rotation_angle
            label: Angle
            type: select
            id: rotation_angle
            options:
                'all': '- All -'
                '45': '45°'
                '90': '90°'
                '180': '180°'
                'all-1': '-------'
                '0-45': '00° - 45°'
                '45-90': '45° - 90°'
                '90-180': '90° - 180°'

    buttons:
        submit:
            value: Filter
    process:
        redirect: >-
            /techs/rotation/{% 
                set rotation_angle = form.value.rotation_angle                                   %}{%
                set rotation_angle = rotation_angle|slice(0,3) == 'all' ? 'all' : rotation_angle %}{%
                set rotation_type   = form.value.rotation_type                                   %}{%
                if rotation_type == 'all'                                                        %}{%
                    if rotation_angle != 'all'                                                   %}{%
                        set filter = 'rotation_angle:' ~ rotation_angle                          %}{%
                    endif                                                                        %}{%
                else                                                                             %}{%
                    if rotation_angle != 'all'                                                   %}{%
                        set filter = rotation_type ~ '_angle:' ~ rotation_angle                  %}{%
                    else                                                                         %}{%
                        set filter = 'function:' ~ rotation_type                                 %}{%
                    endif                                                                        %}{%
                endif                                                                            %}{{ filter }}

---