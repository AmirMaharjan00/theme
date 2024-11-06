import { useState, useEffect } from "react";
const { __ } = wp.i18n;
const { escapeHTML } = wp.escapeHtml;
const { useSelect } = wp.data
const { Tooltip, Dashicon } = wp.components;
const { customize } = wp;
import { store as myCustomStore } from './store';

/**
 * preset list component
 * 
 * MARK: Color Preset
 * @since 1.0.0
 */
export const PresetComponent = ({ handlePresetClick, presetType, color }) => {
    const { getColorsAndVariables, getSolidOrGradient } = useBlogmaticColorPresets()
    const activePreset = Object.entries( getSolidOrGradient( presetType ) )
    const allPresets = getColorsAndVariables()

    return (
        <>
            {
                activePreset.map(([ _thisColor ]) => {
                    return <li className='color-indicator-wrapper'>
                        <span className={ ( _thisColor === color ) && 'active' } style={{ background: allPresets[_thisColor] }} onClick={() => handlePresetClick( _thisColor ) }></span>
                    </li>
                })
            }
        </>
    );
}

PresetComponent.defaultProps = {
    presetType: 'solid'
}

/**
 * preset list component
 * 
 * MARK: Control Title
 * @since 1.0.0
 */
export const BlogmaticControlHeader = ({ label, description, children }) => {
    return(
        <div className='control-title'>
            { label && <span className='customize-control-title'>{ label }</span> }
            { description && <span className='customize-control-description'>{ description }</span> }
            { ( children !== undefined ) && children }
        </div>
    )
}

/**
 * Generate style tag with control id as style id
 * 
 * MARK: Generate Style Tag
 * @since 1.0.0
 */
export const blogmaticGenerateStyleTag = ( id, cssCode ) => {
    let style = document.getElementById( id + '-preset' )    
    if( ! style ) {
        style = document.createElement('style');
        style.id = id + '-preset'
        style.type = 'text/css';
        style.appendChild( document.createTextNode( ':root{'+ cssCode +'}' ));
        // Append the style element to the head of the document
        document.head.appendChild(style);
    } else {
        style.textContent = ''
        style.appendChild( document.createTextNode( ':root{'+ cssCode +'}' ));
    }
}

/**
 * Trigger responsive buttons
 * 
 * MARK: Reflect Responsive in custom controls
 * @since 1.0.0
 */
export const blogmaticReflectResponsiveInControl = ( stateToSet ) => {
    const resFooter = document.getElementById( "customize-footer-actions" )
    const resFooterClass =  resFooter.getElementsByClassName( "devices-wrapper" )
    const buttons = resFooterClass[0].getElementsByTagName( "button" )
    for(  const button of buttons ) {
        button.addEventListener( "click", function() {
            const currentDevice =  button.getAttribute("data-device")
            stateToSet( currentDevice == 'mobile' ? 'smartphone': currentDevice )
        })
    }
}

/**
 * Trigger responsive buttons
 * 
 * MARK: Reflect Responsive in customizer footer icons
 * @since 1.0.0
 */
export const blogmaticReflectResponsiveInCustomizer = ( stateToSet, responsive ) => {
    stateToSet( responsive )
    let footer = document.getElementById('customize-footer-actions')
    if( responsive == 'desktop' ) footer.getElementsByClassName('preview-desktop')[0].click()
    if( responsive == 'tablet' ) footer.getElementsByClassName('preview-tablet')[0].click()
    if( responsive == 'smartphone' ) footer.getElementsByClassName('preview-mobile')[0].click()
}

/**
 * Get responsive icons
 * 
 * MARK: Responsive Icons
 * @since 1.0.0
 */
export const BlogmaticGetResponsiveIcons = ({ responsive, stateToSet, children }) => {
    return <div className="responsive-icons">
        { ( children !== undefined ) && children }
        <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Desktop' ), 'blogmatic-pro' ) }>
            <Dashicon className={ `responsive-trigger ${ ( responsive == 'desktop' ) && "isActive" }` } icon="desktop" onClick={() => stateToSet("desktop") } />
        </Tooltip>
        <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Tablet' ), 'blogmatic-pro' ) }>
            <Dashicon className={ `responsive-trigger ${ ( responsive == 'tablet' ) && "isActive" }` } icon="tablet" onClick={() => stateToSet("tablet") } />
        </Tooltip>
        <Tooltip placement="top" delay={200} text={ __( escapeHTML( 'Mobile' ), 'blogmatic-pro' ) }>
            <Dashicon className={ `responsive-trigger ${ ( responsive == 'smartphone' ) && "isActive" }` } icon="smartphone" onClick={() => stateToSet("smartphone") } />
        </Tooltip>
    </div>
}

/**
 * Blogmatic custom hook for presets
 * 
 * @since 1.0.0
 */
export const useBlogmaticColorPresets = ( color ) => {
    // Data from global state
    const themeColor = useSelect(( select ) => {
        return select( myCustomStore ).getThemeColor()
    }, []);

    const gradientThemeColor = useSelect(( select ) => {
        return select( myCustomStore ).getGradientThemeColor()
    }, []);

    const solidPresets = useSelect(( select ) => {
        return select( myCustomStore ).getSolidColorPreset()
    }, []);

    const gradientPresets = useSelect(( select ) => {
        return select( myCustomStore ).getGradientColorPreset()
    }, []);

    // states
    const [ isPreset, setIsPreset ] = useState( false )

    useEffect(() => {
        if( [color] in getColorsAndVariables() ) {
            setIsPreset( true )
        } else {
            setIsPreset( false )
        }
    }, [ color ])

    /**
     * Get color via variable
     * 
     * @since 1.0.0
     */
    const getColorsAndVariables = () => {
        let collection = {
            '--blogmatic-global-preset-theme-color' : themeColor,
            '--blogmatic-global-preset-gradient-theme-color' : gradientThemeColor
        }
        solidPresets.map(( color, index ) => {
            let count = index + 1
            collection = { ...collection, [ '--blogmatic-global-preset-color-' + count ] : color }
        })
        gradientPresets.map(( color, index ) => {
            let count = index + 1
            collection = { ...collection, [ '--blogmatic-global-preset-gradient-' + count ] : color }
        })

        return collection
    }

    /**
     * Get solid or gradient variables and colors
     * 
     * @since 1.0.0
     */
    const getSolidOrGradient = ( blend ) => {
        let collection
        if( blend === 'gradient' ) {
            collection = { '--blogmatic-global-preset-gradient-theme-color' : gradientThemeColor }
            gradientPresets.map(( color, index ) => {
                let count = index + 1
                collection = { ...collection, [ '--blogmatic-global-preset-gradient-' + count ] : color }
            })
        } else {
            collection = { '--blogmatic-global-preset-theme-color' : themeColor }
            solidPresets.map(( color, index ) => {
                let count = index + 1
                collection = { ...collection, [ '--blogmatic-global-preset-color-' + count ] : color }
            })
        }

        return collection
    }

    return {
        isPreset,
        getColorsAndVariables,
        getSolidOrGradient
    }
}

/**
 * convert number to ordinal string
 * 
 * @since 1.0.0
 * @return string
 */
export const convertNumbertoOrdinalString = ( number ) => {
    let string
    switch( number ) {
        case 2 : 
            string = 'second';
        break;
        case 3 : 
            string = 'third';
        break;
        case 4 : 
            string = 'fourth';
        break;
        case 5 : 
            string = 'fifth';
        break;
        case 6 : 
            string = 'sixth';
        break;
        case 7 : 
            string = 'seventh';
        break;
        case 8 : 
            string = 'eighth';
        break;
        case 9 : 
            string = 'ninth';
        break;
        case 10 : 
            string = 'tenth';
        break;
        default : 
            string = 'first';
        break;
    }
    return string;
}

/**
 * convert number to cardinal string
 * 
 * @since 1.0.0
 * @return string
 */
export const convertNumbertoCardinalString = ( number ) => {
    let string
    switch( number ) {
        case 2 : 
            string = 'two';
        break;
        case 3 : 
            string = 'three';
        break;
        case 4 : 
            string = 'four';
        break;
        case 5 : 
            string = 'five';
        break;
        case 6 : 
            string = 'six';
        break;
        case 7 : 
            string = 'seven';
        break;
        case 8 : 
            string = 'eight';
        break;
        case 9 : 
            string = 'nine';
        break;
        case 10 : 
            string = 'ten';
        break;
        default : 
            string = 'one';
        break;
    }
    return string;
}

/**
 * Detect Back Button click in customizer
 * 
 * MARK: Back Button
 * @since 1.0.0
 */
export const blogmaticBackButtonClick = ( home, sections, resetWidget, resetRows ) => {
    if( sections.length > 0 ) {
        sections.map(( section ) => {
            const sectionInstance = customize.section( section )
            const sectionContainer = sectionInstance.contentContainer
            const backButton = sectionContainer[0].querySelector( '.section-meta .customize-section-back' )
            backButton.addEventListener( "click", function( event ) {
                event.preventDefault()
                event.stopPropagation()
                const sectionInstance = customize.section( home )
                const sectionContent = sectionInstance.contentContainer
                if( sectionContent[0].classList.contains( 'active-builder-setting' ) ) sectionInstance.expand()
                resetWidget( null )
                resetRows( null )
            })
        })
    }
}