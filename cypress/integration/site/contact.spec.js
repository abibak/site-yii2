describe ('Contact page', () => {
    it ('Visit contact page', () => {
        cy.visit('http://yii/site/contact');
        cy.title().should('include', 'Связь с администрцией');
    });

    it ('Fill fields success', () => {
        cy.get('#userrequests-name').type('test name');
        cy.get('#userrequests-email').type('test@mail.ru');
        cy.get('#userrequests-subject').type('Заголовок');
        cy.get('#userrequests-body').type('Описание');
        cy.get('button.btn-primary').click();
        cy.visit('http://yii/site/contact');
    });

    it ('Fill field error no name', () => {
        cy.reload();
        cy.get('#userrequests-email').type('test@mail.ru');
        cy.get('#userrequests-subject').type('Заголовок');
        cy.get('#userrequests-body').type('Описание');
        cy.get('button.btn-primary').click();
    });

    it ('Fill field error no email', () => {
        cy.reload();
        cy.get('#userrequests-name').type('test name');
        cy.get('#userrequests-subject').type('Заголовок');
        cy.get('#userrequests-body').type('Описание');
        cy.get('button.btn-primary').click();
    });

    it ('Fill field error no subject', () => {
        cy.reload();
        cy.get('#userrequests-name').type('test name');
        cy.get('#userrequests-email').type('test@mail.ru');
        cy.get('#userrequests-body').type('Описание');
        cy.get('button.btn-primary').click();
    });

    it ('Fill field error no body', () => {
        cy.reload();
        cy.get('#userrequests-name').type('test name');
        cy.get('#userrequests-email').type('test@mail.ru');
        cy.get('#userrequests-subject').type('Заголовок');
        cy.get('button.btn-primary').click();
    });

    it ('Fields empty', () => {
        cy.reload();
        cy.get('#userrequests-name').focus();
        cy.get('#userrequests-email').focus();
        cy.get('#userrequests-subject').focus();
        cy.get('#userrequests-body').focus();
        cy.get('button.btn-primary').click();
    });
})