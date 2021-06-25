describe ('Index page', () => {
    it ('Visit index page', () => {
        cy.visit('http://yii/site/');
        cy.title().should('include', 'Главная');
    });

    it ('Testing navbar', () => {
        cy.get('.main-link').eq(0).click();
        cy.get('.main-link').eq(1).click();
        cy.go(-1);
        cy.get('.main-link').eq(2).click();
        cy.go(-1);
        cy.get('.main-link').eq(3).click();
        cy.go(-1);
    });

    it ('Testing button record', () => {
        cy.get('button.record-btn').eq(0).click({});
        cy.get('.close-modal').eq(0).click();
        cy.get('button.record-btn').eq(1).click();
        cy.get('.close-modal').eq(0).click();
    });

    it ('Footer testing', () => {
        cy.get('.contact-admin').click();
        cy.go(-1);
    });
});