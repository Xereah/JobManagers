BEGIN
    IF NEW.eq_name != OLD.eq_name THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'eq_name', OLD.eq_name, NEW.eq_name);
    END IF;

    IF NEW.serial_number != OLD.serial_number THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'serial_number', OLD.serial_number, NEW.serial_number);
    END IF;

    IF NEW.entry_date != OLD.entry_date THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'entry_date', OLD.entry_date, NEW.entry_date);
    END IF;

    IF NEW.comments != OLD.comments THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'comments', OLD.comments, NEW.comments);
    END IF;

    IF NEW.company_place != OLD.company_place THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'company_place', OLD.company_place, NEW.company_place);
    END IF;

    IF NEW.eq_category != OLD.eq_category THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'eq_category', OLD.eq_category, NEW.eq_category);
    END IF;

    IF NEW.is_loan != OLD.is_loan THEN
        INSERT INTO rep_equipment_history (equipment_id, field_name, old_value, new_value)
        VALUES (OLD.id, 'is_loan', OLD.is_loan, NEW.is_loan);
    END IF;

END