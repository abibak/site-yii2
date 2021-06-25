describe ('Login page', () => {
    it ('Visit login page', () => {
        cy.visit('http://yii/site/login');
        cy.title().should('include', 'Авторизация');
    });

    it ('Fill fields success', () => {
        cy.get('#loginform-phone').type(79969349264);
        cy.get('#loginform-password').type('admin');
        cy.get('.btn-login').click();
        cy.visit('http://yii/site/');
    });

    it ('Fill field error no phone', () => {
        cy.visit('http://yii/site/login');
        cy.get('#loginform-password').type('admin');
        cy.get('#loginform-phone').focus();
        cy.get('.btn-login').click();
    });

    it ('Fill field error no password', () => {
        cy.visit('http://yii/site/login');
        cy.get('#loginform-phone').type(79969349264);
        cy.get('#loginform-password').focus();
        cy.get('.btn-login').click();
    });

    it ('Fields empty', () => {
        cy.visit('http://yii/site/login');
        cy.get('#loginform-phone').focus();
        cy.get('#loginform-password').focus();
        cy.get('.btn-login').click();
    });
});