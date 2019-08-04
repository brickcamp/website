---
title: Techs
filter_title: true

routes:
    aliases:
        - '/techs/having'
        - '/techs/with'

content:
    items: 
        - '@page.children': '/tech'
    order:
        by: date
        dir: desc
    limit: 12
    pagination: true

########################################################################
# Needed because size of paginated collection can't be queried
# See issue https://github.com/getgrav/grav-plugin-pagination/issues/29
unpaginated:
    items: 
        - '@page.children': '/tech'
########################################################################
---
All techniques
