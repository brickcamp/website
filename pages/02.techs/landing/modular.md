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
            - _shapes
            - _rotations
            - _offsets
    limit: 4
---