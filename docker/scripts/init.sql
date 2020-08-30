CREATE DATABASE moneytransfer;

USE moneytransfer;

CREATE TABLE moneytransfer.customers (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  password VARCHAR(200) NOT NULL,
  email VARCHAR(50) NOT NULL,
  document VARCHAR(20) NOT NULL,
  type varchar(10) NOT NULL,
  value DECIMAL(15,2) NOT NULL DEFAULT '0',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (email),
  UNIQUE KEY (document)
);

CREATE TABLE moneytransfer.tokens (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customers_id INT NOT NULL,
    token VARCHAR(1000) NOT NULL,
    refresh_token VARCHAR(1000) NOT NULL,
    expired_at DATETIME NOT NULL,
    active TINYINT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT fk_tokens_customers_id
        FOREIGN KEY (customers_id) REFERENCES customers(id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE TABLE moneytransfer.transactions (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    payer INT NOT NULL,
    payee INT NOT NULL,
    value DECIMAL(15,2) NOT NULL,
    transaction_code varchar(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payer
        FOREIGN KEY (payer) REFERENCES customers(id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT fk_payee
        FOREIGN KEY (payee) REFERENCES customers(id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);
