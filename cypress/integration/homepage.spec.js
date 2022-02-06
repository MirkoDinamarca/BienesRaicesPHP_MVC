/// <reference types="cypress" />

describe("Carga la página Principal", () => {
    it("Prueba el Header de la página principal", () => {
        cy.visit("/");
    });

    it("Prueba el Bloque de las propiedades", () => {

        // Deben de haber 3 propiedades en la página principal
        cy.get('[data-cy="anuncios-index"]').find(".anuncio").should("have.length", 3);
        cy.get('[data-cy="anuncios-index"]').find(".anuncio").should("not.have.length", 4);

        // Si funciona el enlace
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should("exist");

        cy.go("back");

        cy.get('[data-cy="ver-propiedades"]').first().click();
        cy.get('[data-cy="propiedades-completas"]').should("exist");

        cy.go("back");


    });
});