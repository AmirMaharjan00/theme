const { useState, useEffect } = wp.element;
const { customize } = wp;
const { __ } = wp.i18n;
const { escapeHTML } = wp.escapeHtml;
import AsyncSelect from 'react-select/async'
import Select from 'react-select'
import { BlogmaticControlHeader } from './component-function'

export const BlogmaticAsyncMultiselect = ( props ) => {
    const [ value, setValue ] = useState( props.value )
    const [ choices, setChoices ] = useState([])

    const { label, description, endpoint, purpose: querySlug } = customize.settings.controls[ props.setting ]
    const HOMEURL = customize.settings.url.home
    const ROUTE = HOMEURL + 'wp-json/blogmatic/v1/'
    const API = ROUTE + endpoint + '?query_slug=' + querySlug

    /**
     * Trigger the publish button in customizer &&
     * save the data in database &&
     * get initial choices
     */
    useEffect(() => {
        let toExclude = value.map(( current ) => {
            return current.value
        })
        let refinedApi = API + ( ( value.length > 0 ) ? ( '&exclude=' + toExclude.join() ) : '' )
        fetch( refinedApi, {
            method: 'GET',
            headers: {
                "X-WP-Nonce": window.wpApiSettings.nonce
            }
        }).
        then(( result ) => result.json() ).
        then(( data ) => setChoices( data ))
        customize.value( props.setting )( value )
    }, [ value ])

    /**
     * update the searched state
     * 
     * @since 1.0.0
     */
    const updateSearchedState = ( inputValue ) => {
        let refinedApi = API + ( inputValue ? ( '&s=' + inputValue ) : '' )
        let searched = fetch( refinedApi, {
            method: 'GET',
            headers: {
                "X-WP-Nonce": window.wpApiSettings.nonce
            }
        } ).
        then(( result ) => result.json() ).
        then(( data ) => { return data } )
        return searched
    }


    return (
        <div className='field-main'>
            <BlogmaticControlHeader label={ label } description={ description } />
            { <AsyncSelect
                isMulti = { true }
                inputId = "blogmatic-search-in-select"
                isSearchable  = { true }
                heading = { label }
                placeholder = { __( escapeHTML( 'Type to search . . ' ), 'blogmatic-pro' ) }
                value = { value }
                defaultOptions = { choices }
                loadOptions = { updateSearchedState }
                onChange = { ( newMultiselect ) => setValue( newMultiselect ) }
            /> }
        </div>
    )
}

export const BlogmaticMultiselect = ( props ) => {
    const [ value, setValue ] = useState( props.value )
    const { label, description, choices } = customize.settings.controls[ props.setting ]

    /**
     * Trigger the publish button in customizer &&
     * save the data in database &&
     * get initial choices
     */
    useEffect(() => {
        customize.value( props.setting )( value )
    }, [ value ])

    return (
        <div className='field-main'>
            <BlogmaticControlHeader label={ label } description={ description } />
            { <Select
                isMulti = { true }
                inputId = "blogmatic-search-in-select"
                isSearchable  = { true }
                heading = { label }
                placeholder = { __( escapeHTML( 'Type to search . . ' ), 'blogmatic-pro' ) }
                defaultValue = { value }
                options = { choices }
                onChange = { ( newMultiselect ) => setValue( newMultiselect ) }
            /> }
        </div>
    )
}