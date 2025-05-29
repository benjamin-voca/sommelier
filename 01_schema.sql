USE mydatabase;
CREATE TABLE Fragrances (
    id INT AUTO_INCREMENT,
    dior VARCHAR(4096) NOT NULL,
    original VARCHAR(4096) NOT NULL,
    dupe VARCHAR(4096) NOT NULL,
    PRIMARY KEY (id)
);