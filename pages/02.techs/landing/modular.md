---
title: Techs
routes:
    default: '/techs'

content:
    items: '@self.modular'
    order:
        by: default
        custom:
            - _newest
            - _rotations
            - _offsets
            - _shapes
    limit: 4
---