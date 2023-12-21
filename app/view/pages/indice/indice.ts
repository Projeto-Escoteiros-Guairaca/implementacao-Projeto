import { Breadcrumb, BreadcrumbItemModel } from '@syncfusion/ej2-navigations';

let items: BreadcrumbItemModel[] = [
    {
        iconCss: 'e-icons e-home',
        url: "https://ej2.syncfusion.com/demos",
    },
    {
        text: "Components",
        url: "https://ej2.syncfusion.com/demos/#/material/grid/grid-overview",
    },
    {
        text: "Navigations",
        url: "https://ej2.syncfusion.com/demos/#/material/menu/default",
    },
    {
        text: "Breadcrumb",
        url: "./breadcrumb/default",
    }
];

new Breadcrumb({
    items: items,
    enableNavigation: false
}, '#breadcrumb');