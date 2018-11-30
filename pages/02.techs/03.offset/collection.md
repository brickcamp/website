---
title: Offset
image: image.png
filter: filter-offsets

content:
    items: 
        - '@taxonomy.function': stud_shift
        - '@taxonomy.function': stud_lift
        - '@taxonomy.function': axle_shift
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-offsets
    id: items-filter
    fields:
        -
            name: offset_type
            label: Type
            type: select
            id: offset_type
            options:
                'all': '- All -'
                'stud_lift': 'Stud Lift'
                'stud_shift': 'Stud Shift'
                'axle_shift': 'Axle Shift'

        - 
            name: offset_length
            label: Length
            type: select
            id: offset_length
            options:
                'all': '- All -'
                '1'  : '01 LDU'
                '2'  : '02 LDU'
                '5'  : '05 LDU | 1/4 Stud'
                '10' : '10 LDU | 1/2 Stud'

    buttons:
        submit:
            value: Filter
    process:
        redirect: >-
            /techs/offset/{% 
                set offset_length = form.value.offset_length                                     %}{%
                set offset_length = offset_length|slice(0,3) == 'all' ? 'all' : offset_length    %}{%
                set offset_type   = form.value.offset_type                                       %}{%
                if offset_type == 'all'                                                          %}{%
                    if offset_length != 'all'                                                    %}{%
                        set filter = 'offset_length:' ~ offset_length                            %}{%
                    endif                                                                        %}{%
                else                                                                             %}{%
                    if offset_length != 'all'                                                    %}{%
                        set filter = offset_type ~ '_length:' ~ offset_length                    %}{%
                    else                                                                         %}{%
                        set filter = 'function:' ~ offset_type                                   %}{%
                    endif                                                                        %}{%
                endif                                                                            %}{{ filter }}

---