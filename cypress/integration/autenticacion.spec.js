/// <reference types="cypress" />

describe("Prueba la autenticación", () => {
    it("Prueba la autenticación en el login", () => {
        cy.visit("login");

        cy.get('[data-cy="formulario-login"]').should("exist");

        // Con error
        cy.get('[data-cy="input-email"]').type("estecorreo@correo.com");
        cy.get('[data-cy="input-password"]').type("123456");
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-error"]').should("exist");

        // Sin error
        cy.get('[data-cy="input-email"]').type("correo@correo.com");
        cy.get('[data-cy="input-password"]').type("123456");
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="titulo-administracion"]').should("exist");

    });
});