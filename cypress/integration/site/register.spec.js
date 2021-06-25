describe ('Register page', () => {
    it ('Visit register page', () => {
        cy.visit('http://yii/site/register');
        cy.title().should('include', 'Регистрация');
    });

    it ('Fill fields form', () => {
        cy.get('#users-name').type('test');
        cy.get('#users-surname').type('test');
        cy.get('#users-patronymic').type('test');
        cy.get('#users-phone').type(1234567);
        cy.get('#users-password').type('test123');
        cy.get('.btn-register').click();
    });

    it ('Fill field error no name', () => {
        cy.reload();
        cy.get('#users-surname').type('test');
        cy.get('#users-patronymic').type('test');
        cy.get('#users-phone').type(1234567);
        cy.get('#users-password').type('test123');
        cy.get('#users-name').focus();
        cy.get('.btn-register').click();
    });
    
    it ('Fill field error no surname', () => {
        cy.reload();
        cy.get('#users-name').type('test');
        cy.get('#users-patronymic').type('test');
        cy.get('#users-phone').type(1234567);
        cy.get('#users-password').type('test123');
        cy.get('#users-surname').focus();
        cy.get('.btn-register').click();
    });

    it ('Fill field error no patronymic', () => {
        cy.reload();
        cy.get('#users-name').type('test');
        cy.get('#users-surname').type('test');
        cy.get('#users-phone').type(1234567);
        cy.get('#users-password').type('test123');
        cy.get('#users-patronymic').focus();
        cy.get('.btn-register').click();
    });

    it ('Fill field error no phone', () => {
        cy.reload();
        cy.get('#users-name').type('test');
        cy.get('#users-surname').type('test');
        cy.get('#users-patronymic').type('test');
        cy.get('#users-password').type('test123');
        cy.get('#users-phone').focus();
        cy.get('.btn-register').click();
    });

    it ('Fill field error no password', () => {
        cy.reload();
        cy.get('#users-name').type('test');
        cy.get('#users-surname').type('test');
        cy.get('#users-patronymic').type('test');
        cy.get('#users-phone').type('test123');
        cy.get('#users-password').focus();
        cy.get('.btn-register').click();
    });
})