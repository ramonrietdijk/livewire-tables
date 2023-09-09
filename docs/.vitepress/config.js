export default {
    title: 'Livewire Tables',
    description: 'Dynamic tables for models with Laravel Livewire',
    lang: 'en-US',
    base: '/livewire-tables',
    themeConfig: {
        logo: 'https://ramonrietdijk.nl/img/logo.svg',
        socialLinks: [
            {
                icon: 'github',
                link: 'https://github.com/ramonrietdijk/livewire-tables'
            }
        ],
        footer: {
            message: 'Released under the MIT License',
            copyright: 'Copyright &copy; 2023-present Ramon Rietdijk'
        },
        nav: [
            {
                text: 'Demo',
                link: 'https://livewire-tables.ramonrietdijk.nl'
            }
        ],
        sidebar: [
            {
                text: 'Getting Started',
                collapsed: false,
                items: [
                    {
                        text: 'Introduction',
                        link: '/getting-started/introduction'
                    },
                    {
                        text: 'Requirements',
                        link: '/getting-started/requirements'
                    },
                    {
                        text: 'Installation',
                        link: '/getting-started/installation'
                    },
                    {
                        text: 'Example',
                        link: '/getting-started/example'
                    },
                ]
            },
            {
                text: 'Usage',
                collapsed: false,
                items: [
                    {
                        text: 'Table',
                        link: '/usage/table'
                    },
                    {
                        text: 'Columns',
                        link: '/usage/columns'
                    },
                    {
                        text: 'Filters',
                        link: '/usage/filters'
                    },
                    {
                        text: 'Actions',
                        link: '/usage/actions'
                    },
                    {
                        text: 'Soft Deletes',
                        link: '/usage/soft-deletes'
                    },
                    {
                        text: 'Links',
                        link: '/usage/links'
                    },
                    {
                        text: 'Reordering',
                        link: '/usage/reordering'
                    },
                    {
                        text: 'Exports',
                        link: '/usage/exports'
                    }
                ]
            },
            {
                text: 'Configuration',
                collapsed: false,
                items: [
                    {
                        text: 'Defer Loading',
                        link: '/configuration/defer-loading'
                    },
                    {
                        text: 'Polling',
                        link: '/configuration/polling'
                    },
                    {
                        text: 'Query String',
                        link: '/configuration/query-string'
                    }
                ]
            },
            {
                text: 'Advanced',
                collapsed: false,
                items: [
                    {
                        text: 'Metadata',
                        link: '/advanced/metadata'
                    },
                    {
                        text: 'Relations',
                        link: '/advanced/relations'
                    },
                    {
                        text: 'Efficiency',
                        link: '/advanced/efficiency'
                    }
                ]
            }
        ]
    }
}
