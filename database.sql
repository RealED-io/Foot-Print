CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reference_activities
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(100)   NOT NULL,
    unit            VARCHAR(20)    NOT NULL,
    emission_factor DECIMAL(10, 4) NOT NULL,
    baseline_id     INT            NULL,

    CONSTRAINT fk_reference_baseline
        FOREIGN KEY (baseline_id)
            REFERENCES reference_activities (id)
            ON DELETE SET NULL
            ON UPDATE CASCADE
);

CREATE TABLE activities
(
    id                    INT AUTO_INCREMENT PRIMARY KEY,
    user_id               INT            NOT NULL,
    reference_activity_id INT            NOT NULL,
    value                 DECIMAL(10, 2) NOT NULL,
    created_at            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_activities_user
        FOREIGN KEY (user_id)
            REFERENCES users (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,

    CONSTRAINT fk_activities_reference
        FOREIGN KEY (reference_activity_id)
            REFERENCES reference_activities (id)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
);

CREATE INDEX idx_activities_user_id
    ON activities (user_id);

CREATE INDEX idx_activities_created_at
    ON activities (created_at);

CREATE INDEX idx_activities_user_created_at
    ON activities (user_id, created_at);