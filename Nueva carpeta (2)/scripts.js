// Initialize Firebase
const firebaseConfig = {
    apiKey: "TU_API_KEY",
    authDomain: "TU_DOMINIO.firebaseapp.com",
    projectId: "TU_PROJECT_ID",
    storageBucket: "TU_STORAGE_BUCKET",
    messagingSenderId: "TU_MESSAGING_SENDER_ID",
    appId: "TU_APP_ID",
    measurementId: "TU_MEASUREMENT_ID"
};
firebase.initializeApp(firebaseConfig);
firebase.analytics();

const auth = firebase.auth();

// Registro de usuario
const signupForm = document.getElementById('signupForm');
if (signupForm) {
    signupForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const username = signupForm['username'].value;
        const email = signupForm['email'].value;
        const password = signupForm['password'].value;
        const passwordConfirm = signupForm['passwordConfirm'].value;
        if (password === passwordConfirm) {
            auth.createUserWithEmailAndPassword(email, password)
                .then((userCredential) => {
                    // Usuario registrado exitosamente
                    const user = userCredential.user;
                    console.log('Usuario registrado:', user);
                    // Guardar datos adicionales del usuario en Firestore
                    // Por ejemplo, guardar el nombre de usuario
                    firebase.firestore().collection('users').doc(user.uid).set({
                        username: username
                    });
                })
                .catch((error) => {
                    // Manejar errores de registro
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    console.error('Error al registrar:', errorMessage);
                });
        } else {
            alert('Las contraseñas no coinciden.');
        }
    });
}

// Inicio de sesión de usuario
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = loginForm['email'].value;
        const password = loginForm['password'].value;
        auth.signInWithEmailAndPassword(email, password)
            .then((userCredential) => {
                // Usuario inició sesión exitosamente
                const user = userCredential.user;
                console.log('Usuario inició sesión:', user);
            })
            .catch((error) => {
                // Manejar errores de inicio de sesión
                const errorCode = error.code;
                const errorMessage = error.message;
                console.error('Error al iniciar sesión:', errorMessage);
            });
    });
}
