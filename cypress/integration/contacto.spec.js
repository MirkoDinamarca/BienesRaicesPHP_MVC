/// <reference types="cypress" />

describe("Prueba el formulario de contacto", () => {
    it("Llena los campos del formulario", () => {
        cy.visit("contactos");

        cy.get('[data-cy="input-nombre"]').type("Mirko");
        cy.get('[data-cy="input-mensaje"]').type("Deseo comprar una casa enorme para poder irme vivir bien lejos");
        cy.get('[data-cy="input-opciones"]').select("Compra");
        cy.get('[data-cy="input-precio"]').type("15000000");

        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type("2994044950");
        cy.get('[data-cy="input-fecha"]').type("2022-02-14");
        cy.get('[data-cy="input-hora"]').type("10:30");

        cy.get('[data-cy="formulario-contacto"]').submit();
        cy.get('[data-cy="alerta-mensaje"]').should("exist");








    });
});