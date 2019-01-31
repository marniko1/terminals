
----------------------------------------------------------------------------------------------------------------------

create or replace function SWITCH_DEVICES (_old_device_id integer, _locations_id integer, _new_device_id integer, _malfunction_id integer, _repairer_id integer, _comment character varying(255), _user_id integer, _action_type_id integer)
returns void as
$$
	BEGIN
	
	insert into devices_locations values (default, _old_device_id, 3, _user_id, default);
	insert into devices_locations values (default, _new_device_id, _locations_id, _user_id, default);
	insert into malfunctions_history values (default, _old_device_id, _locations_id, _malfunction_id, _comment, _action_type_id, _repairer_id, _user_id, default);

	END;
$$
LANGUAGE plpgsql;

----------------------------------------------------------------------------------------------------------------------
create or replace function INSERT_NEW_LOCATION (_new_location text,  _priority integer, _distributor_id integer)
returns void as
$$
	DECLARE
	location_id integer;
	BEGIN
	
	insert into locations values (default, _new_location, _priority);
	if _distributor_id != 0 then
		select max(id) from locations into location_id;
		insert into locations_distributors values (default, location_id, _distributor_id);
	end if;
	END;
$$
LANGUAGE plpgsql;
----------------------------------------------------------------------------------------------------------------------
create or replace function INSERT_NEW_DEVICE (_sn text,  _type_id integer, _model_id integer)
returns void as
$$
	DECLARE
	device_id integer;
	BEGIN
	
	insert into devices values (default, _sn, _type_id);
	if _model_id != 0 then
		select max(id) from devices into device_id;
		insert into devices_models values (default, device_id, _model_id);
	end if;
	END;
$$
LANGUAGE plpgsql;
----------------------------------------------------------------------------------------------------------------------
create or replace function DEVICE_SOFTWARE_CHANGE (_device_id integer, _software_id integer)
returns void as
$$
	DECLARE
	devices_locations_id integer;
	BEGIN
	
	select id from devices_locations where device_id = _device_id into devices_locations_id;

	if devices_locations_id is not null then
		update devices_softwares set software_id = _software_id where device_id = _device_id;
	end if;
	if devices_locations_id is null then
		insert into devices_softwares values (default, _device_id, _software_id);
	end if;
	END;
$$
LANGUAGE plpgsql;