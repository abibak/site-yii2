describe ('Products page', () => {
    it ('Visit products page', () => {
        cy.visit('http://yii/site/products');
        cy.title().should('include', 'Товары');
    });

    it ('Add product to cart', () => {
        cy.get('.add-cart').click({'multiple': true});
        cy.get('.shopping-cart').click();
    });
    
    it ('Clear cart', () => {
        cy.wait(800);
        cy.get('.clear-cart').click();
        cy.wait(500);
        cy.get('.close-modal').click({'force': true, 'multiple': true});
    });
});