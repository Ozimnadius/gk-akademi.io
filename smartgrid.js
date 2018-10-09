const smartgrid = require('smart-grid');

smartgrid('./css/layout', {
    mobileFirst: false,
    columns: 24,
    offset: "30px",
    outputStyle: "scss",
    container: {
        maxWidth: "1200px",
        fields: "30px",
    },
    breakPoints: {
        lg: {
            width: "1199.99px",
            fields: "20px",
        },
        md: {
            width: "991.99px",
            fields: "20px",
        },
        sm: {
            width: "767.99px",
            fields: "20px",
        },
        xs: {
            width: "575.99px",
            fields: "20px",
        }
    },
});