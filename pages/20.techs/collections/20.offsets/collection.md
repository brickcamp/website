---
title: Offsets
image: image.png
filter: filter-offsets

content:
    items: 
        - '@taxonomy.function': stud_shift
        - '@taxonomy.function': stud_lift
        - '@taxonomy.function': axle_shift
    filter:
        published: true
        type: 'tech'    
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

form:
    name: filter-offsets
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
                    name: offset_type
                    label: Type
                    type: select
                    id: offset_type
                    classes: custom-select
                    options:
                        'all': 'All Types'
                        'stud_lift': 'Stud Lift'
                        'stud_shift': 'Stud Shift'
                        'axle_shift': 'Axle Shift'
                - 
                    name: offset_length
                    label: Length
                    type: select
                    id: offset_length
                    classes: custom-select
                    options:
                        'all': 'All Lengths'
                        '10' : '1/2 Stud'
                        '5'  : '1/4 Stud'
                        '2'  : '1/10 Stud'
                        '1'  : '1/20 Stud'
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
            /techs/collections/offsets/{% 
                set offset_length = form.value.offset_length                                     %}{%
                set offset_length = offset_length|slice(0,3) == 'all' ? 'all' : offset_length    %}{%
                set offset_type   = form.value.offset_type                                       %}{%
                if offset_type == 'all'                                                          %}{%
                    if offset_length != 'all'                                                    %}{%
                        set filter = 'offset_length:' ~ offset_length  ~ '/'                     %}{%
                    endif                                                                        %}{%
                else                                                                             %}{%
                    if offset_length != 'all'                                                    %}{%
                        set filter = offset_type ~ '_length:' ~ offset_length  ~ '/'             %}{%
                    else                                                                         %}{%
                        set filter = 'function:' ~ offset_type  ~ '/'                            %}{%
                    endif                                                                        %}{%
                endif                                                                            %}{{ filter }}{%
                set order_by = form.value.order_by                                               %}{%
                set order_dir = form.value.order_dir                                             %}{%
                set ordering = 'orderby:' ~ order_by ~ '/orderdir:' ~ order_dir                  %}{{ ordering }}

---