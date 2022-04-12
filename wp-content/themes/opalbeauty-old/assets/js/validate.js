var validator = validator;
const isEmail = validator.isEmail;
const isISO8601 = validator.isISO8601;
const isIn = validator.isIn;
const escape = validator.escape;
const trim = validator.trim;
const normalizeEmail = validator.normalizeEmail;
const toDate = validator.toDate;
const reqValidator = (validation, data) => {
    try {
        const errors = {};
        for (const key in validation) {
            for (const type of validation[key].type) {
                handleValidator[type](key, validation[key].name || key, errors, data);
            }
        }
        return errors
    }catch (err) {
        throw new Error(err.message);
    }
}
const textError = {
    missing: (name) => `Please enter ${ name }`,
    format: (name, format) => `Please enter correct format ${ name }`,
    short: (name, min) => `Please enter ${ name } minimum ${ min } characters`,
    long: (name, max) => `Please enter ${ name } less than ${ max } characters`,
    radio: (name, radio) => `Please choose ${ name } is ${ radio }`,
}

const messError = {
    required: (name) => textError.missing(name),
    in: (name) => textError.radio(name, 'Male or female or other gender'),
    date: (name) => textError.format('Date/Month/Year'),
    email: (name) => textError.format(name, 'Email'),
    phone: (name) => textError.format(name),
    password: (name) => textError.short(name, 5),
}

const handleValidator = {
    required: (key, name, errors, data) => !data[key] ?  errors[key] = messError.required(name) : data[key] = escape(trim(data[key])),
    file: (key, name, errors, data) => !data[key] ?  errors[key] = messError.required(name) : data[key] = data[key],
    mutiple: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = undefined;
        if(!data[key][0]){
            return errors[key] = messError.required(name)
        }
    },
    in: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = undefined;

        if(!isIn(data[key], ['F', 'M', 'O']))
            return errors[key] = messError.in(name)

        data[key] = escape(trim(data[key]))
    },
    date: (key, name, errors, data) => {
        let date = data[key];
        if(!date)
            return data[key] = undefined;
        
        if( date.split("/").length == 3){
            const dataSplit = date.split("/");
            date = dataSplit[2] + '-' + dataSplit[1] + '-' + dataSplit[0]
        }else if(data[key].split("-").length == 3){
            const dataSplit = date.split("-");
            date = dataSplit[2] + '-' + dataSplit[1] + '-' + dataSplit[0]
        }
        
        if(!isISO8601(date))
        {
            return errors[key] = messError.date(name)
        }

            
        data[key] = toDate(trim(date));

    },
    email: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = undefined;

        if(!isEmail(data[key]))
            return errors[key] = messError.email(name)

        data[key] = normalizeEmail(trim(data[key]))
    },
    password: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = undefined;

        if(data[key].length < 5)
            return errors[key] = messError.password(name)

        data[key] = trim(data[key])
    },
    phone: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = undefined;

        if(!validatePhone(data[key]))
            return errors[key] = messError.phone(name)

        data[key] = trim(data[key])
    },
    text: (key, name, errors, data) => {
        if(!data[key])
            return data[key] = "";

        data[key] = trim(data[key])
    },
}


const setNullVal = (data, valSet)=> {
    try {
        for (const vlS of valSet) {
            if(!data[vlS]) data[vlS] = null;
        }

    }
    catch (err) {
        throw new Error(err.message);
    }
}


function getQueryParams(query) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(query);
}