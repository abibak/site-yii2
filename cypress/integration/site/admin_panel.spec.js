describe ('Testing admin panel', () => {
    it ('Visit employees page', () => {
        cy.visit('http://yii/admin/employees/index');
    });

    it ('Add employee success', () => {
        cy.get('.btn-success').click();
        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');
        cy.get('.btn-success').click();
    });

    it ('Fill field error no name', () => {
        cy.visit('http://yii/admin/employees/index');
        cy.get('.btn-success').click();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Fill field error no surname', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Fill field error no patronymic', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Fill field error no age', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Fill field error no phone', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Incorrect email', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('email');
        cy.get('#employee-salary').click().type('10000');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });

    it ('Fill field error no name', () => {
            cy.visit('http://yii/admin/employees/index');
            cy.get('.btn-success').click();

            cy.get('#employee-position_id').select('1').should('have.value', '5');
            cy.get('#employee-surname').click().type('test-surname');
            cy.get('#employee-patronymic').click().type('test-patronymic');
            cy.get('#employee-age').click().type('30');
            cy.get('#employee-phone').click().type(780034853);
            cy.get('#employee-email').click().type('test@mail.ru');
            cy.get('#employee-salary').click().type('10000');
            cy.get('#employee-status').select('Активен').should('have.value', '1');

            cy.get('.btn-success').click();
        });

    it ('Fill field error no salary', () => {
        cy.reload();

        cy.get('#employee-position_id').select('1').should('have.value', '5');
        cy.get('#employee-name').click().type('test-name');
        cy.get('#employee-surname').click().type('test-surname');
        cy.get('#employee-patronymic').click().type('test-patronymic');
        cy.get('#employee-age').click().type('30');
        cy.get('#employee-phone').click().type(780034853);
        cy.get('#employee-email').click().type('test@mail.ru');
        cy.get('#employee-status').select('Активен').should('have.value', '1');

        cy.get('.btn-success').click();
    });
});