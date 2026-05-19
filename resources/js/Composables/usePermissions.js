import { computed } from 'vue'

export const usePermissions = (auth) => {
    /**
     * Verificar si el usuario actual tiene un rol específico
     * @param {string} role - Nombre del rol a verificar
     * @returns {boolean}
     */
    const hasRole = (role) => {
        if (!auth || !auth.user) return false
        return auth.user.roles?.some(r => r.name === role) || false
    }

    /**
     * Verificar si el usuario actual tiene un permiso específico
     * @param {string} permission - Nombre del permiso a verificar
     * @returns {boolean}
     */
    const hasPermission = (permission) => {
        if (!auth || !auth.user) return false
        return auth.user.permissions?.some(p => p.name === permission) || false
    }

    /**
     * Verificar si el usuario actual tiene alguno de los roles especificados
     * @param {string[]} roles - Array de nombres de roles
     * @returns {boolean}
     */
    const hasAnyRole = (roles) => {
        return roles.some(role => hasRole(role))
    }

    /**
     * Verificar si el usuario actual tiene alguno de los permisos especificados
     * @param {string[]} permissions - Array de nombres de permisos
     * @returns {boolean}
     */
    const hasAnyPermission = (permissions) => {
        return permissions.some(permission => hasPermission(permission))
    }

    /**
     * Verificar si el usuario actual tiene todos los roles especificados
     * @param {string[]} roles - Array de nombres de roles
     * @returns {boolean}
     */
    const hasAllRoles = (roles) => {
        return roles.every(role => hasRole(role))
    }

    /**
     * Verificar si el usuario actual tiene todos los permisos especificados
     * @param {string[]} permissions - Array de nombres de permisos
     * @returns {boolean}
     */
    const hasAllPermissions = (permissions) => {
        return permissions.every(permission => hasPermission(permission))
    }

    return {
        hasRole,
        hasPermission,
        hasAnyRole,
        hasAnyPermission,
        hasAllRoles,
        hasAllPermissions,
    }
}
