export default [
    {
        _name: 'CSidebarNav',
        _children: [
            {
                _name: 'CSidebarNavItem',
                name: 'Consulta',
                to: '/dashboard',
                icon: 'cil-speedometer',
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Suspeitas',
                to: '/theme/colors',
                icon: 'cil-drop'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Sinal',
                to: '/theme/typography',
                icon: 'cil-pencil'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Minhas Consultas',
                to: '/theme/typography',
                icon: 'cil-pencil'
            },
        ]
    }
]
