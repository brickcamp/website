---
title: Abstände
icon: icon.png
filter: filter-offsets

content:
    items: 
        - '@taxonomy.function': stud_shift
        - '@taxonomy.function': stud_lift
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
        - '@taxonomy.function': stud_shift
        - '@taxonomy.function': stud_lift
    filter:
        published: true
        type: 'tech'   
########################################################################

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
                    label: Art
                    type: select
                    id: offset_type
                    classes: custom-select
                    options:
                        'all': 'Alle Arten'
                        'stud_lift': 'Noppen-Lift'
                        'stud_shift': 'Noppen-Shift'
                - 
                    name: offset_length
                    label: Länge
                    type: select
                    id: offset_length
                    classes: custom-select
                    options:
                        'all': 'Alle Längen'
                        '10' : '1/2 Noppe'
                        '5'  : '1/4 Noppe'
                        '4'  : '1/5 Noppe'
                        '2'  : '1/10 Noppe'
                        '1'  : '1/20 Noppe'
                        'flex' : Flexibel
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
            /de/techs/offsets/{% 
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