describe ('Test online record', () => {
    it ('Visit index page', () => {
        cy.visit('http://yii/site/');
        cy.title().should('include', 'Главная');
    });

    it ('Record Miron', () => {
        cy.get('.record').click();
        cy.get('.open-employees').click();
        cy.get('.master').first().click();
        cy.get('.open-list').click();
        cy.get('.service-card .name-service').first().click({'force': true});
        cy.get('.service-card .name-service').first().next().click({'force': true});
        cy.get('#date').focus().type('2021-06-26').blur();

        cy.get('.model-btn-record').click();
    });

    it ('Record Maksim', () => {
        cy.reload();
        cy.get('.record').click();
        cy.get('.open-employees').click();
        cy.get('.master').first().next().click();
        cy.get('.open-list').click();
        cy.get('.service-card .name-service').first().click({'force': true});
        cy.get('.service-card .name-service').first().next().click({'force': true});
        cy.get('#date').focus().type('2021-06-26').blur();
        
        cy.get('.model-btn-record').click();
    });
});